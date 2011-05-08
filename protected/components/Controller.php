<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public static $RIGHT_SIDEBAR;

	/**
	 * @var string the default layout for the controller view. Defaults to 'application.views.layouts.column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init()
	{
		self::$RIGHT_SIDEBAR = $this->renderPartial( 'application.components.views._right_sidebar_main', null, true );
		return parent::init();
	}

    public static function makeMePretty( $string )
    {
        $retval = strtolower( $string );
        // $this->url=strtr($this->url, "áéíóöőúüű", "aeiooouuu");
        $retval = trim(preg_replace(array('/[^a-z0-9-]/', '/-+/'), array('-','-'), $retval), '-');
        
        return $retval;
    }
}
