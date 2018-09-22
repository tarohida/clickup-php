<?php

namespace ClickUp\Objects;

class Space extends AbstractObject
{
	/* @var int $id*/
	private $id;

	/* @var string $name */
	private $name;

	/* @var bool $isPrivate */
	private $isPrivate;

	/* @var StatusCollection $statuses */
	private $statuses;

	/* @var array $clickApps */
	private $clickApps;

	/* @var Team|null $team */
	private $team;

	/**
	 * @return int
	 */
	public function id()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * @return bool
	 */
	public function isPrivate()
	{
		return $this->isPrivate;
	}

	/**
	 * @return StatusCollection
	 */
	public function statuses()
	{
		return $this->statuses;
	}

	/**
	 * @return array
	 */
	public function clickApps()
	{
		return $this->clickApps;
	}

	/**
	 * @return ProjectCollection
	 */
	public function projects()
	{
		$projects = $this->client()->projects($this->id());
		$projects->setSpace($this);
		return $projects;
	}

	/**
	 * Access parent class.
	 *
	 * @return Team|null
	 */
	public function team()
	{
		return $this->team;
	}

	/**
	 * @param Team $team
	 */
	public function setTeam(Team $team)
	{
		$this->team = $team;
	}

	/**
	 * @param array $array
	 */
	public function fromArray($array)
	{
		$this->id = $array['id'];
		$this->name = $array['name'];
		$this->isPrivate = $array['private'];
		$this->statuses = new StatusCollection(
			$this->client(),
			$array['statuses']
		);
		$this->clickApps = [
			'multiple_assignees' => isset($array['multiple_assignees']) ? $array['multiple_assignees'] : false,
			'due_dates' => isset($array['features']['due_dates']['enabled']) ? $array['features']['due_dates']['enabled'] : false,
			'time_tracking' => isset($array['features']['time_tracking']['enabled']) ? $array['features']['time_tracking']['enabled'] : false,
			'priorities' => isset($array['features']['priorities']['enabled']) ? $array['features']['priorities']['enabled'] : false,
			'tags' => isset($array['features']['tags']['enabled']) ? $array['features']['tags']['enabled'] : false,
			'time_estimates' => isset($array['features']['time_estimates']['enabled']) ? $array['features']['time_estimates']['enabled'] : false,
			'check_unresolved' => isset($array['features']['check_unresolved']['enabled']) ? $array['features']['check_unresolved']['enabled'] : false,
			'custom_fields' => isset($array['features']['custom_fields']['enabled']) ? $array['features']['custom_fields']['enabled'] : false,
			'remap_dependencies' => isset($array['features']['remap_dependencies']['enabled']) ? $array['features']['remap_dependencies']['enabled'] : false,
			'dependency_warning' => isset($array['features']['dependency_warning']['enabled']) ? $array['features']['dependency_warning']['enabled'] : false,
		];
	}
}