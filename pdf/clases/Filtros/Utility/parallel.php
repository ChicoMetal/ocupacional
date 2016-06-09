<?php
// Include the Genius config file
require_once dirname(dirname(__FILE__)) .'/Core/testConfig.inc.php';

class Par extends gosUtility_Parallel {
    public function __construct($maxWorkers) {
        parent::__construct($maxWorkers);

        // Redefine the logger
        gosUtility_parallel::$logger = Log5PHP_Manager::getLogger('gosParallel.Par');
    }

    protected function doWorkChildImpl() {
        $childNum = getmypid();
        gosUtility_parallel::$logger->debug("Child $childNum started");

        // Run until told not to
        global $run;
        while ($run) {
            gosUtility_parallel::$logger->debug("Child $childNum doing work.");
            usleep(2000000);
        }
    }

    protected function parentCleanup() {
        gosUtility_parallel::$logger->debug("Parent cleaning up");
    }

    protected function childCleanup() {
        gosUtility_parallel::$logger->debug("Child $childNum cleaning up");
    }
}

// Make with the go
$par = new Par(2);
$par->go();
