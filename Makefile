PHPSPEC=vendor/bin/phpspec
PORT=8000

run-tests: ; $(PHPSPEC) run
coverage-report: ; $(PHPSPEC) run -v
coverage-report-server: ; php -S localhost:$(PORT) -t coverage/
