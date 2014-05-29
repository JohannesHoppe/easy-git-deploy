<?php

class Deploy extends VcsAbstract {
    /**
     * Extracts the host of git@bitbucket.org:xxx/xxx
     */
    /*
    private function extract_host_from_git_url($url) {
        $matches = null;
        preg_match('/git@([^:]+):/',$url, $matches);
        return $matches[1];
    }
    */

    /**
     * Executes the necessary commands to deploy the website.
     */
    public function execute() {
        try {
            if (!$this->has_base_directory()) {
                mkdir($this->_directory, 0777, true);
            }

            // Make sure we're in the right directory
            chdir($this->_directory);

            if (!is_dir('./.git')) {
                // only first run

                // TODO: finish ssh implementation
                //$host = $this->extract_host_from_git_url($this->_url);
                //$this->exec_and_log('Adding remote server to list of known hosts.', 'ssh '.$host.' -o StrictHostKeyChecking=no ');

                // The "." at the end specifies the current folder as the checkout folder!
                $this->exec_and_log('Cloning repo for the first time.', "git clone '" . $this->_url . "' .");
            }
            else {
                // normal run

                // Move to master branch.
                $this->exec_and_log('Switching to master branch.', 'git checkout ' . $this->_branch);

                // Move to master branch.
                $this->exec_and_log('Cleaning master branch.', 'git reset --hard');

                // Update the local repository
                $this->exec_and_log('Pulling in changes.', 'git pull ' . $this->_remote . ' ' . $this->_branch);
            }

            // Secure the .git directory
            // $this->exec_and_log('Securing .git directory.', 'chmod -R og-rx .git');

            // Execute post deploy callback.
            $this->post_deploy();

            $this->log('Deployment successful.');
        }
        catch (Exception $e) {
            $this->log($e, 'ERROR');
        }
    }
}