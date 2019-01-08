workflow "Main Workflow" {
  on = "push"
  resolves = [
    "Code Style Analysis",
    "Unit Tests",
  ]
}

action "Build" {
  uses = "./actions/build"
  secrets = ["SUPER_SECRET_KEY"]
}

action "Unit Tests" {
  uses = "./actions/test"
  needs = ["Build"]
}

action "Code Style Analysis" {
  uses = "./actions/phpcs"
  needs = ["Build"]
}
