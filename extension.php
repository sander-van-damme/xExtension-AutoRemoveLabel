<?php
class AutoRemoveLabelExtension extends Minz_Extension
{
	public function init()
	{
		$this->registerHook('freshrss_user_maintenance', array($this, 'removeLabels'));
	}

	public function removeLabels()
	{
		$tagDao = FreshRSS_Factory::createTagDao();
		$tags = $tagDao->selectAll();
		foreach ($tags as $tag) {
			if (!$tagDao->countEntries($tag["id"])) {
				$tagDao->deleteTag($tag["id"]);
			}
		}
	}
}
