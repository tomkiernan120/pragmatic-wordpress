var lodash = require("lodash");
var Generator = require("yeoman-generator");
var path = require("path");

module.exports = class extends Generator {
  constructor(args, opts) {
    // Calling the super constructor is important so our generator is correctly set up
    super(args, opts);

    this.parentAnswers = opts.answers;

    this.spawnCommandSync("pwd");
    this.spawnCommandSync("ls", ["wp-content"]);

    this.spawnCommandSync("pwd");
  }

  async prompting() {
    this.answers = await this.prompt([
      {
        type: "input",
        name: "name",
        message: "Theme name",
      },
      {
        type: "checkbox",
        name: "packages",
        message: "Select from commonly used libraries",
        choices: [
          "slick-carousel",
          "boostrap",
          "jquery",
          "vue",
          "react",
          "gsap",
          "aos",
          "scrollTrigger",
        ],
      },
    ]);
  }

  async writing() {
    const packageJson = {
      name: this.answers.name,
      version: "1.0.0",
      description: "",
      main: "index.js",
      scripts: {
        watch: "webpack --watch",
        build: "webpack --env production --env mode=production",
      },
      author: "",
      license: "ISC",
      files: ["generators"],
      dependencies: {
        "@babel/core": "^7.15.8",
        "@babel/preset-env": "^7.15.8",
        "babel-loader": "^8.2.3",
        "browser-sync": "^2.27.5",
        "browser-sync-webpack-plugin": "^2.3.0",
        "css-loader": "^6.4.0",
        "import-glob-loader": "^1.1.0",
        "mini-css-extract-plugin": "^2.4.2",
        "node-sass-glob-importer": "^5.3.2",
        sass: "1.32.13",
        "sass-loader": "^12.2.0",
        "style-loader": "^3.3.0",
        "ts-loader": "^9.2.6",
        typescript: "^4.4.4",
        webpack: "^5.58.2",
        "webpack-cli": "^4.9.1",
      },
      devDependencies: {
        "@cypress/browserify-preprocessor": "^3.0.1",
        cypress: "^8.7.0",
        husky: "^7.0.0",
        "pretty-quick": "^3.1.1",
      },
    };

    //   // create package.json
    await this.fs.writeJSON(
      this.destinationPath(
        `wp-content/themes/${this.answers.name}/package.json`
      ),
      packageJson
    );

    // copy template
    await this.fs.copyTpl(
      this.templatePath("**/*"),
      this.destinationPath(`wp-content/themes/${this.answers.name}`)
    );

    await this.fs.commit([], () => {
      console.log("commit");
      this._installDependencies();
      this._installComposer();
    });
  }

  async _installDependencies() {
    if (this.answers && this.answers.packages && this.answers.packages.length) {
      var npmdir = path.join(
        process.cwd(),
        `/wp-content/themes/${this.answers.name}`
      );

      console.log(npmdir);

      process.chdir(npmdir);
      this.addDependencies(this.answers.packages);
    }
  }

  async _installComposer() {
    // run composer install
    await this.spawnCommandSync("composer", ["install"], {
      cwd: this.destinationPath(`wp-content/themes/${this.answers.name}`),
    });
  }
};
