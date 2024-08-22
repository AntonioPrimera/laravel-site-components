<?php
namespace AntonioPrimera\SiteComponents\ViewModels;

use Illuminate\Contracts\Support\Arrayable;

class NavItemCollection implements Arrayable
{
	public array $navItems = [];
	
	public function __construct(array $navItems)
	{
		foreach ($navItems as $navItem) {
			is_array($navItem) ? $this->createFromArray($navItem) : $this->add($navItem);
		}
	}
	
	public static function create(): self
	{
		return new self([]);
	}
	
	public function add(NavItem $navItem): static
	{
		$this->navItems[] = $navItem;
		return $this;
	}
	
	public function item(string $label, string $url, bool $active = false): static
	{
		$this->add(new NavItem($label, $url, $active));
		return $this;
	}
	
	public function createFromArray(array $data): static
	{
		$this->add(NavItem::createFromArray($data));
		return $this;
	}
	
	public function toArray()
	{
		return array_map(fn($navItem) => $navItem->toArray(), $this->navItems);
	}
}