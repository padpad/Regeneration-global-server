<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 *
 * @package    Modular Gaming
 * @author     Copy112
 * @copyright  (c) 2010 Copy112
 * @license    http://copy112.com/mg/license
 */

class Model_Zone extends Jelly_Model {
	
	public static function initialize(Jelly_Meta $meta)
	{
		
		$meta->fields += array(
			'id' => new Field_Primary,
			'name' => new Field_String,
			'description' => new Field_Text,
			'energy' => new Field_Integer,
		
			'monster' => new Field_ManyToMany(array(
                'model' => 'monster',
                'through' => 'zone_monster'
            )),
            
            'shops' => new Field_HasMany,
		);
		
	}
	
}