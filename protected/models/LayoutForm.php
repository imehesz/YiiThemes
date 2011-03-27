<?php
    /**
     * LayoutForm  
     * 
     * @uses CFormModel
     * @package 
     * @version $id$
     * @copyright Mehesz LLC
     * @author Imre Mehesz <imehesz@gmail.com> 
     * @license PHP Version 5 {@link http://www.php.net/license/3_01.txt}
     */
    class LayoutForm extends CFormModel
    {
        /**
         * theme  
         * 
         * @var mixed
         * @access public
         */
        public $theme;

        /**
         * layout  
         * 
         * @var mixed
         * @access public
         */
        public $layout;

        /**
         * _layouts  
         * 
         * @var string
         * @access private
         */
        private $_layout_types = array( 'SL', 'SR', 'DD', 'TR' );

        /**
         * getLayoutTypes  
         * 
         * @access public
         * @return void
         */
        public function getLayoutTypes()
        {
            return $this->_layout_types;
        }

        /**
         * downloadLayout 
         * 
         * @param mixed $layout 
         * @param mixed $theme 
         * @access public
         * @return void
         */
        public function downloadLayout( $layout, $theme )
        {
        }
    }
