<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 29.08.14
 * Time: 20:11
 */

namespace Avkdev\YmParserBundle\Parser;

use Avkdev\YmParserBundle\Entity\Task;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractParser extends ContainerAware
{
    /**
     * @var Task
     */
    protected $task;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var array
     */
    protected $progressStatus = array(
        'numPage' => 1
    );

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Run parser
     */
    public function run()
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        /** @var $tasks \Doctrine\Common\Collections\ArrayCollection */
        $tasks = $this->container->get('avkdev_ym_parser.task_repository')->getUnresolvedTasks();

        $this->output->writeln("Num tasks: " . $tasks->count());

        /** @var $task \Avkdev\YmParserBundle\Entity\Task */
        foreach ($tasks as $task) {
            $this->task = $task;
            $this->persistStatus(Task::STATUS_PROCESSING);
            try {
                $this->loadProgressStatus();
                $this->parse();
                $this->persistStatus(Task::STATUS_DONE);
            } catch (Exception $e) {
                $this->persistStatus(Task::STATUS_ERROR);
            }
        }
        return $this;
    }

    /**
     * Save task status
     * @param $status
     * @return $this
     */
    public function persistStatus($status)
    {
        $this->task->setStatus($status);
        $this->em->persist($this->task);
        $this->em->flush();
        return $this;
    }

    /**
     * Load progress status for task
     * @return $this
     */
    protected function loadProgressStatus()
    {
        $this->progressStatus = $this->task->getProgressStatus();
        if (empty($this->progressStatus)) {
            $this->progressStatus = array(
                'numPage' => 1
            );
        }
        return $this;
    }

    /**
     * main parser method
     * @return $this
     */
    protected function parse()
    {
        $maxNumPages = $this->container->getParameter('ymparser_num_pages');
        $sleepTime = $this->container->getParameter('ymparser_sleep_time');
        // start parsing
        for ($i = $this->getNumPage(); $i <= $maxNumPages; $i++) {
            $this->setNumPage($i);
            $this->parsePage();
            sleep($sleepTime);
        }
        return $this;
    }

    /**
     * @return int
     */
    protected function getNumPage()
    {
        return $this->progressStatus['numPage'];
    }

    /**
     * @param $num integer
     * @return $this
     */
    protected function setNumPage($num)
    {
        $this->progressStatus['numPage'] = $num;
        return $this;
    }

    /**
     * Parse current page
     * @return $this
     */
    protected function parsePage()
    {
        $this->saveProgressStatus();
        $url = $this->buildUrl();
        $this->output->writeln("Parsing page {$this->getNumPage()}: $url");
        $browser = $this->container->get('buzz.browser');
        $entities = $this->makeOutHtml($browser->get($url, $this->getHeaders()));
        $this->persistProducts($entities);
        return $this;
    }

    /**
     * Save current task state
     * @return $this
     */
    protected function saveProgressStatus()
    {
        $this->task->setProgressStatus($this->progressStatus);
        $this->em->persist($this->task);
        $this->em->flush();
        return $this;
    }

    /**
     * Build url for creating request
     * @return string
     */
    abstract protected function buildUrl();

    /**
     * @param $response \Buzz\Message\Response
     * @return mixed
     */
    abstract protected function makeOutHtml($response);

    /**
     * @return array
     */
    protected function getHeaders()
    {
        return array();
    }

    /**
     * @param array $entities
     */
    abstract protected function persistProducts(array $entities);

    /**
     * @param OutputInterface $output
     * @return $this
     */
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    /**
     * Calculate page offset for load a specified page
     * @param $numPage
     * @return int
     */
    protected function buildPageOffset($numPage)
    {
        return $numPage;
    }
}
