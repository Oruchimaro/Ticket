## Packages

-   [Spatie Translation](https://spatie.be/docs/laravel-translatable/v6/installation-setup)
-   [Filament Translation](https://filamentphp.com/plugins/solution-forest-translate-field#form-component)
-   [laravel translatable](https://github.com/Astrotomic/laravel-translatable?tab=readme-ov-file)

# Docs

-   Duster : [here](https://github.com/tighten/duster)
-   HowToUse : [here](https://tighten.com/insights/husky-how-to-automatically-format-lint-and-test-before-you-commit-or-push/)
-   PrettierFOrBlade : [here](https://mattstauffer.com/blog/how-to-set-up-prettier-on-a-laravel-app-to-lint-tailwind-class-order-and-more/)

## Using Reverb

## Reverb

### Install Reverb

```bash
	# Laravel 11
	sail artisan install:broadcasting
```

```bash
# Env file
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=835672
REVERB_APP_KEY=br7pjbbzjdflea8mpnd9
REVERB_APP_SECRET=2sgcpuz1ter6fzdpwl2l
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

REVERB_SERVER_PORT=8080

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"

```

```yml
# docker-compose.yml
services:
    laravel.test:
        ports:
            # ...
            - '${REVERB_SERVER_PORT:-8080}:8080'
```

### Testing if reverb(websocket) works :

```bash
	sail artisan make:livewire Sample
	sail artisan make:event TestEvent
```

```php
// Sample.php
<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Sample extends Component
{
    public function render()
    {
        return view('livewire.sample');
    }

	// use echo:<Channel Name>,<Event name>
    #[On('echo:sampleChannel,TestEvent')]
    public function dump()
    {
        dd('here');
    }
}
```

```html
<!-- sample.blade.php -->
<div>{{-- Success is as dangerous as failure. --}} sample blade</div>
```

```php

// TestEvent.php
//  implements ShouldBroadcastNow
<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function broadcastOn(): array
    {
        return [
            new Channel('sampleChannel'),
        ];
    }
}

```

```html
<!-- test-reverb.blade.php -->
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />

		<title>Laravel</title>

		@vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body>
		@livewire('sample')
	</body>
</html>
```

```php
// web.php
Route::get('/reverb', fn () => view('test-reverb'));
```

```bash
sail up -d
sail artisan reverb:start
sail artisan queue:work
sail npm run dev

sail artisan tinker

# open browser
App\Events\TestEvent::dispatch()
```

-   [Helpful Tip When Using Sail](https://github.com/laravel/framework/discussions/50625)
