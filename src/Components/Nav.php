<?php
namespace AntonioPrimera\SiteComponents\Components;

use AntonioPrimera\SiteComponents\ViewModels\NavItemCollection;
use Illuminate\View\Component;
use Illuminate\View\View;

class Nav extends Component
{

    public function __construct(public iterable $items = [])
    {
		$this->items = $this->items ?: $this->getNavItems();
    }

    public function render(): View
    {
        return view('site::nav');
    }
	
	//override this method in your child class to define the nav items
	protected function navItems(): array|NavItemCollection
	{
		return [];
	}
	
	//--- Protected helpers -------------------------------------------------------------------------------------------
	
	protected function getNavItems(): array
	{
		$navItems = $this->navItems();
		return $navItems instanceof NavItemCollection ? $navItems->toArray() : $navItems;
	}
}
