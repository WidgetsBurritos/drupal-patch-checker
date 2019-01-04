workflow "Test Readiness" {
  on = "push"
  resolves = ["action-phpcs", "action-test"]
}

action "action-phpcs" {
  uses = "./action-phpcs/"
}

action "action-test" {
  uses = "./action-test/"
}
