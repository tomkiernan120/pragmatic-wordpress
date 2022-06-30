const { default: slugify } = require("slugify");
const path = require("path");
var Generator = require("yeoman-generator");
var ThemeGenerator = require("generator-pragmatic-wordpress-theme");

module.exports = class extends Generator {
  async prompting() {
    this.answers = await this.prompt([
      {
        type: "input",
        name: "name",
        message: "Your project name",
        default: this.appname, // Default to current folder name
        filter: function (val) {
          return slugify(val, { lower: true });
        },
      },
      {
        type: "confirm",
        name: "defaultTheme",
        message: "Use default theme?",
        default: false,
      },
      {
        type: "confirm",
        message: "Run theme generator?",
        name: "run_theme_generate",
        default: true,
      },
      {
        type: "confirm",
        name: "use_lando",
        message: "Use lando for development?",
        default: false,
      },
    ]);
  }

  async writing() {
    // clone wordpress
    await this.spawnCommandSync("git", [
      "clone",
      "git@github.com:WordPress/WordPress.git",
      this.destinationRoot(),
    ]);

    // move wordpress to root
    // await this.spawnCommandSync("mv", ["Wordpress/*", "./"]);

    // delete Wordpress folder
    // await this.spawnCommandSync("rm", ["-rf", "Wordpress"]);

    // delete .git folder
    await this.spawnCommandSync("rm", ["-rf", this.destinationPath(".git")]);
    await this.spawnCommandSync("rm", ["-rf", this.destinationPath(".github")]); // potential to break if added into existing repo

    if (!this.answers.defaultTheme) {
      // delete theme
      console.log('delete themes')
      await this.spawnCommandSync("rm", [
        "-rf",
        path.join(this.destinationPath("wp-content/themes"), '/*'),
      ]);
    }

    if (this.answers.use_lando) {
      // copy dot files files
      await this.fs.copy(this.templatePath(".lando.yml"), this.destinationRoot());
    }

    if (this.answers.run_theme_generate) {
      // run theme generator
      await this.composeWith(require.resolve("./theme"), {
        answers: this.answers,
      });
    }
  }
};
