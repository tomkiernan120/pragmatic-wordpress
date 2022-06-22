var Generator = require("yeoman-generator");

module.exports = class extends Generator {
  constructor(args, opts) {
    // Calling the super constructor is important so our generator is correctly set up
    super(args, opts);
    
    this.answers = opts.answers;
  }

//   async prompting() {
//     this.answers = [...this.answers, ...await this.prompt([
//         {
//             type: "input",
//         }
//     ])];
//   }

  async writing() {
    const packageJson = {
      name: "",
      version: "0.0.1",
      description: "",
      main: "index.js",
      keywords: [],
      license: "MIT",
      repository: {},
    };

    // create package.json
    await this.fs.writeJSON(this.destinationPath(`wp-content/themes/${this.answers.name}/package.json`), packageJson);

    // copy template
    await this.fs.copyTpl(
        this.templatePath("**/*"),
        this.destinationPath(`wp-content/themes/${this.answers.name}`)
    );

    await this.fs.commit([], () => {
      console.log('commit');
      this._installComposer();
    })
  }
  
  async _installComposer () {
  
    // run composer install
    await this.spawnCommandSync("pwd");
    await this.spawnCommandSync("composer", ["install"], {
      cwd: this.destinationPath(`wp-content/themes/${this.answers.name}`),
    });
  }
};
