
DC := docker exec -it
FPM := $(DC) eori
FPM_SU := $(DC) --user=root eori
CURRENT_UID := $(shell id -u)

.PHONY: ssh ssh-su

up:
	@make start
	@make ssh

ssh:
	@$(FPM) bash

ssh-su:
	@$(FPM_SU) bash

start:
	docker compose -f docker-compose.yml up -d

stop:
	docker compose -f docker-compose.yml down

build:
	docker compose build
