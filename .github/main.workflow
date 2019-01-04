workflow "Test Readiness" {
  on = "push"
  resolves = [
    "test",
    "phpcs",
  ]
}

action "./action-build/" {
  uses = "./action-build/"
}

action "test" {
  uses = "./action-test"
  needs = ["./action-build/"]
}

action "phpcs" {
  uses = "./action-phpcs"
  needs = ["./action-build/"]
}
