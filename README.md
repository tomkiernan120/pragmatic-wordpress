# Pragmatic Digital Static Site Builder
This tool is used to build simple static sites using html, scss and JS.


## Installation

First, install [Yeoman](http://yeoman.io) and pragmatic-wordpress using [npm](https://www.npmjs.com/) (we assume you have pre-installed [node.js](https://nodejs.org/)).

```bash
npm install -g yo
npm install -g generator-pragmatic-wordpress
```

Then generate your new project:

```bash
yo pragmatic-wordpress
```

This will then asks you questions about the project and set it up with our regular build process

This will automatically run composer and npm install

## currently in development

You can also run

```bash
yo pragmatic-wordpress:theme
```
This will just generate the theme, this is currently tied too closely by paths to the parent generator

## License

Apache-2.0 ©

# TODO
- Setup Lando for spinning up the development environment easier
- Setup Husky so all commits are uniform
- Update any missing dependancies
- Add a sub generator for creating plugins
- correctly delink the theme sub generator from the parent generator