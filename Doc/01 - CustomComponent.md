# Building a custom widget

Documentation [Here](https://filamentphp.com/docs/3.x/panels/dashboard#custom-widgets)

1 - run the command to create a new widget template

```bash
	php artisan make:filament-widget MetricWidget
```

This created the file `app/Filament/Admin/Widgets/MetricWidget.php` file and it will be shown on dashboard.

We don't want filament to auto-discover this file, so we move it to another namespace.So if we refresh we wont see the widget on dashboard.
