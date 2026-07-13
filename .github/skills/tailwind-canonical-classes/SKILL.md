---
name: tailwind-canonical-classes
description: Always use Tailwind CSS suggested canonical utility classes and canonical class ordering when writing or editing class attributes.
argument-hint: 'Tailwind class list or component to normalize'
license: MIT
---

# Tailwind Canonical Classes

Use this skill whenever writing or editing Tailwind class attributes.

## Rules

- Prefer Tailwind's suggested canonical utility classes.
- Avoid non-canonical aliases or redundant utility combinations when a canonical form exists.
- Keep class lists in canonical order (layout to spacing to typography to visual effects, with state and responsive variants grouped consistently).
- When editing existing markup, normalize only the class tokens you touch unless the user asks for full-file cleanup.

## Examples

- Prefer `shrink-0` instead of legacy `flex-shrink-0`.
- Prefer `rounded-s-md` and `rounded-e-md` instead of `rounded-l-md` and `rounded-r-md` when directional canonical forms are suggested.
- Keep variant utilities grouped predictably, e.g. base classes first, then `sm:`, `md:`, `lg:`, and state modifiers like `hover:` and `focus:`.

## Success Criteria

- New or changed Tailwind classes use canonical utility names.
- Class ordering is consistent and predictable.
- No unrelated class cleanup is performed unless requested.
