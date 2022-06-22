const { default: slugify } = require("slugify");
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
      "git://develop.git.wordpress.org/",
      this.destinationRoot(),
    ]);

    // delete .git folder
    await this.spawnCommandSync("rm", ["-rf", this.destinationPath(".git")]);

    if (!this.answers.defaultTheme) {
      // delete theme
      await this.spawnCommandSync("rm", [
        "-rf",
        this.destinationPath("wp-content/themes"),
      ]);
    }

    if (this.answers.run_theme_generate) {
      // run theme generator
      await this.composeWith(require.resolve("./theme"), {
        answers: this.answers,
      });
    }

    if (this.answers.use_lando) {
      // run lando init
      await this.spawnCommandSync("lando", [
        "init",
        "--recipe",
        "wordpress",
        "--name",
        this.answers.name,
      ]);
    }
  }
};
