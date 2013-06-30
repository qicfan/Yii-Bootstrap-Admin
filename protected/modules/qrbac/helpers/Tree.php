<?php
/**
 * 树形结构
 * @auther Baiqing Wu <wbqyyicx@gmail.com>
 * @package system.lib.code applied to actions model(curd)
 * @copyright Copyright (c) 2011 窝窝团
 * @since 1.0
 */
class Tree
{
	/**
	* 换行图标
	*
	* @since 1.0
	* @access private
	* @var array
	*/
	private static $icon = array('│','├',' └');

	/**
	 * 初始化的二维数组
	 *array(
	 *      1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
	 *      2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
	 *      3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
	 *      4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
	 *      5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
	 *      6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
	 *      7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
	 *      )
	 * @since 1.0
	 * @access public
	 * @var array
	 */
	public static $arr = array();

	/**
	 * 得到的树形结构
	 *
	 * @since 1.0
	 * @access public
	 * @var string
	 */
	static $string;

	/**
	 * 得到子ID
	 *
	 * @param <type> $child
	 * @return <type>
	 */
	public static function getChild($child_id)
	{
		$new_array = $id = '';

		if(is_array(self::$arr))
		{
			foreach(self::$arr as $id =>$val)
			{
				if(isset($val['parent_id']) && $val['parent_id'] == $child_id){
					$new_array[$id] = $val;
				}
			}
		}

		return $new_array;
	}

	/**
	 * 得到树形结构
	 *
	 * @param int $parent_id
	 * @param string $string  #"<option value=\$id \$selected>\$spacer\$name</option>"#
	 * @param string $adds
	 * @access public
	 * @since 1.0
	 * @return string
	 */
	public static function getTree($parent_id , $string, $sid = 0,$style_selected = true,$where_arr = false,$adds = '')
	{
		$child_id = self::getChild($parent_id);
		$number = 1;

		if(is_array($child_id))
		{
			$total = count($child_id);
			foreach($child_id as $id => $val)
			{
				$j = $k = '';

				if($style_selected == true)
				{
					if($number == $total) {
						$j.=self::$icon['2'];
					} else {
						$j.=self::$icon['1'];
						$k = $adds ? self::$icon['0'] : $adds;
					}
				}

				$spacer = $adds ? $adds.$j : '';
//				$selected = $id==$sid ? 'selected' : '';
				@extract($val);
				eval("\$str = \"$string\";");

				self::$string.=$str;
				self::getTree($id, $string, $sid ,$style_selected,$where_arr,$adds.$k.'&nbsp;');
				$number++;
			}
		}
		return self::$string;
	}
}