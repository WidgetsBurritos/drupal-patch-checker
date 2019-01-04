workflow "Main Workflow" {
  on = "push"
  resolves = [
    "Code Style Analysis",
    "Unit Tests",
  ]
}

action "Build" {
  uses = "./actions/build"
}

action "Unit Tests" {
  uses = "./actions/test"
  needs = ["Build"]
}

action "Code Style Analysis" {
  uses = "./actions/phpcs"
  needs = ["Build"]
}
