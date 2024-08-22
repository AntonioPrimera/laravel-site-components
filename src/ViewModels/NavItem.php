<?php
namespace AntonioPrimera\SiteComponents\ViewModels;

use Illuminate\Contracts\Support\Arrayable;

class NavItem implements Arrayable
{
	public function __construct(
		public string $label,
		public string $url,
		public bool $active = false
	) {}
	
	public static function createFromArray(array $data): self
	{
		return new self(
			label: $data['label'] ?? '',
			url: $data['url'] ?? '',
			active: $data['active'] ?? false
		);
	}
	
	public function toArray(): array
	{
		return [
			'label' => $this->label,
			'url' => $this->url,
			'active' => $this->active
		];
	}
}