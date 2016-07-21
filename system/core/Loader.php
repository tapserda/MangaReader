<?php
    namespace Core;

    /**
     * Provide method to load specific class or file from recognized package like
     * library, page, etc.
     *
     * @package Core
     */
    class Loader
    {
        /**
         * Load a page. This function shouldn't be called normally and only be used
         * on routing class which will call specific handler page.
         *
         * @param  string $name   Page name
         * @param  string $method Method in Page class that need to be called
         */
        public function page($name, $method='index')
        {
            if ($name==='')
            {
                $name = 'home';
            }

            $page = $this->loadClass($name, 'Page');

            if ($page === false || method_exists($page, $method) === false)
            {
                notFound($name . ($method!='index'?'/'.$method:''));
            }
            else
            {
                $page->$method();
            }
        }

        public function dbDriver($name)
        {
            return $this->loadClass($name, 'DB/Driver');
        }

        /**
         * Find and load file if file is exists.
         *
         * @param  string $name    File name
         * @param  string $package Package where file is placed
         * @param  array  $data    Data that need to be passed to the file
         *
         * @return bool            True if file is exists and loaded, false otherwise
         */
        private function loadFile($name, $package='library', $data=array())
        {
            $vendors =& loadClass('Vendor', 'Core');
            $list = $vendors->lists();

            foreach ($list as $vendor)
            {
                if (file_exists($vendor . '/' . $package . '/' . $name . '.php'))
                {
                    include ($vendor . '/' . $package . '/' . $name . '.php');
                    return true;
                }
            }

            return false;
        }

        /**
         * Load class and it's file if file
         *
         * @param  string $name    Class name
         * @param  string $package Package name where file class is located
         *
         * @return object          Instance of the class
         */
        private function &loadClass($name, $package='library')
        {
            $vendors =& loadClass('Vendor', 'Core');
            $list = $vendors->lists();
            return loadClass($name, $package, $list);
        }
    }

?>