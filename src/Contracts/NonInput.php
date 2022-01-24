<?php

namespace Galahad\Aire\Contracts;

/**
 * Indicates that the Element shouldn't be treated as an input
 * (skip value binding, x-model, etc). Because Aire is a form builder,
 * most elements *are* inputs, so this interface is explicitly a
 * negation (as opposed to having an Input interface).
 */
interface NonInput
{
}
