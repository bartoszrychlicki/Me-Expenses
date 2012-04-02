<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initTwitterBootstrap()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        
        $view->headLink()->appendStylesheet('/css/bootstrap.css');
        $view->headLink()->appendStylesheet('/css/bootstrap-responsive.css');
        $view->headScript()->appendFile('/js/bootstrap.min.js', $type = 'text/javascript');
    }

	protected function _initViewHelpersPaths()
	{
        $this->bootstrap('view');
        $view = $this->getResource('view');
		$view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Noumenal_View_Helper');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Application_View_Helper');

	}
    
    /**
    * init jquery view helper, enable jquery, jqueryui, jquery ui css
    */
    protected function _initJquery() {
        $this->bootstrap('view');
        $view = $this->getResource('view'); //get the view object

        //add the jquery view helper path into your project
        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");

        //jquery lib includes here (default loads from google CDN)
        $view->jQuery()->enable()->setVersion('1.7.2');//jQuery version, automatically 1.5 = 1.5.latest
    }

	protected function _initFireBugLogger()
	{
            if(!$this->_isDebugEnabled('firebuglogger')) return false;
            $writer = new Zend_Log_Writer_Firebug();
            $logger = new Zend_Log($writer);
            Zend_Registry::set('log', $logger);
            return $logger;
		
	}
	
	protected function _isDebugEnabled($mode, $onlyDevelopment = true) {
            $env = $this->_application->getEnvironment();
            if(!strstr($env, 'development') and $onlyDevelopment === true) {
                    return false;
            }
            $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini');
    if($config->development->debugging->$mode->enable == false) return false;
            return true;
	}
}

