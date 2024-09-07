<?php
namespace AntonioPrimera\SiteComponents\Components;

use AntonioPrimera\SiteComponents\ViewModels\NavItemCollection;
use Illuminate\View\Component;
use Illuminate\View\View;

abstract class Nav extends Component
{
	public NavItemCollection $navItemCollection;
	public array $navItems;
	protected string $viewName = 'site::nav';
	
    public function __construct()
    {
		$this->navItemCollection = $this->navItems();
		$this->navItems = $this->navItemCollection->toArray();
    }

    public function render(): View
    {
        return view($this->viewName);
    }
	
	/**
	 * Define your nav items here
	 */
	abstract protected function navItems(): NavItemCollection;
}
