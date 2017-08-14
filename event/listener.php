<?php
/**
*
* @package phpBB Extension - Highlight first post on every page
* @copyright (c) 2017 Татьяна5
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/
namespace tatiana5\highlightfirstpost\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
/**
* Assign functions defined in this class to event listeners in the core
*
* @return array
* @static
* @access public
*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.viewtopic_get_post_data'				=> array('viewtopic_get_post_data', -2),
		);
	}

	/** @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	*/
	public function __construct(\phpbb\template\template $template)
	{
		$this->template = $template;
	}

	public function viewtopic_get_post_data($event)
	{
		$topic_data = $event['topic_data'];

		if (!empty($topic_data['topic_first_post_show']) || !empty($topic_data['first_post_always_show']))
		{
			$this->template->assign_var('FIRST_POST_SHOW', true);
		}
	}
}
