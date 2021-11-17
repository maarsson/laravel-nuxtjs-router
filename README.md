# NuxtJS router for Laravel

This package adds a fallback routing to your Laravel-NuxtJS project.

## Usage

1. Add package to your Laravel project: `composer require maarsson/laravel-nuxtjs-router`
2. Set up frontend generate folder path in your NuxtJS config in order to build the generated files under Laravels `public` folder. In your `nuxt.config.js`:
    ```
    generate: {
        dir: '../public/_nuxt'
    },
    ```
    You may change the relative path in the example above, according to your NuxtJS placement in your project.
3. Generate NuxtJs frontend.
4. Open your project in the browser.


## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
