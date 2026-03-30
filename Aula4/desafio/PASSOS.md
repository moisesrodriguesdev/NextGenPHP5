# Refatoração Clean Code
Fala a refatoração do arquivo Refatorar.php, de acordo com os passos abaixo, seguindo as boas práticas do Clean Code:

---

## Passos para a refatoração

**Passo 1 — Renomeie tudo.** `$t` → `$title`, `$p` → `$priority`, `$d` → `$deadline`, `$dl` → `$deadline`, `$dn` → `$doneCount`. Remova todas as abreviações.

**Passo 2 — Crie a classe `Task`.** Mova `title`, `priority`, `done` e `deadline` para uma classe com construtor tipado. A tarefa sabe se está atrasada (`isOverdue()`) e sabe se completar (`complete()`).

**Passo 3 — Early return.** Em `complete()`, inverta as condições: se não existe, retorne false; se já feita, retorne false; complete e retorne true. Zero else, zero aninhamento.

**Passo 4 — Separe o relatório.** Extraia uma classe `TaskReport` que recebe a lista e gera a saída. `TaskMgr` (agora `TaskList`) cuida só de adicionar, completar e filtrar.

**Passo 5 — Adicione type hints.** `function add(string $title, int $priority, ?string $deadline): void`. Ative `declare(strict_types=1)`.