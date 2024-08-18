# Building a custom widget

Documentation [Here](https://filamentphp.com/docs/3.x/panels/dashboard#custom-widgets)

1 - run the command to create a new widget template

```bash
	php artisan make:filament-widget MetricWidget
```

This created the file `app/Filament/Admin/Widgets/MetricWidget.php` file and it will be shown on dashboard.

We don't want filament to auto-discover this file, so we move it to another namespace.So if we refresh we wont see the widget on dashboard.

2 - Copy what is needed from `Filament\Widgets\StatsOverviewWidget\Stat` class into the widget component.
Also we should copy the related html from stat blade file.Pay attention that the stat blade file is blade component and the variables from class can be accessed like "$variable" or "$method" but the CustomWidget is a livewire component, so we should prefix them with this keyword like "$this->variable" or "$this->method".
