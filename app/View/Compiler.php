<?php

namespace App\View;

use TrueFrame\View\Compiler as BaseCompiler;
use InvalidArgumentException;

class Compiler extends BaseCompiler
{
    /**
     * Stop the current section.
     *
     * Fixes the base class bug where ->render() is called on the string
     * returned by View::make(), causing a TypeError.
     *
     * @return void
     * @throws InvalidArgumentException
     */
    public function stopSection(): void
    {
        $last = array_pop($this->sectionStack);

        if (is_null($last)) {
            throw new InvalidArgumentException('Cannot stop a section without first starting one.');
        }

        $this->sections[$last] = ob_get_clean();

        // If a layout is being extended, render it
        if (!empty($this->layoutStack) && $last === '__content') {
            $layout = array_pop($this->layoutStack);
            // View::make() returns a string already — no need for ->render()
            echo $this->viewFactory->make($layout, get_defined_vars());
        }
    }

    /**
     * Compile the @extends directive.
     *
     * Fixes the base class bug where:
     * 1) stopSection() is always appended even without @extends
     * 2) Layout name was pushed to layoutStack at compile-time, making it
     *    unavailable when serving from cache. Now the push happens at render-time
     *    via pushLayout() embedded in the compiled PHP.
     *
     * @param string $value
     * @return string
     */
    protected function compileLayouts(string $value): string
    {
        $pattern = '/@extends\s*\(\s*([\'"])(.*?)\1\s*\)/';
        $hasExtends = false;

        $value = preg_replace_callback($pattern, function ($matches) use (&$hasExtends) {
            $hasExtends = true;
            $layout = $matches[2];
            // Push layout at RENDER-TIME, not compile-time
            return "<?php \$__env->pushLayout('{$layout}'); \$__env->startSection('__content'); ?>";
        }, $value);

        // Only append stopSection if @extends was actually found
        if ($hasExtends) {
            $value .= "<?php \$__env->stopSection(); ?>";
        }

        return $value;
    }

    /**
     * Push a layout name onto the layout stack at render-time.
     *
     * @param string $layout
     * @return void
     */
    public function pushLayout(string $layout): void
    {
        $this->layoutStack[] = $layout;
    }

    /**
     * Compile the TrueBlade template string.
     *
     * Overrides the base to compile control structures BEFORE echos,
     * so that inline @if(...){{ expr }}@endif patterns don't break.
     *
     * @param string $value
     * @return string
     */
    protected function compileString(string $value): string
    {
        $value = $this->compileComments($value);
        $value = $this->compileLayouts($value);
        $value = $this->compileSections($value);
        $value = $this->compileYields($value);
        $value = $this->compileIncludes($value);
        // Control structures FIRST (before echos)
        $value = $this->compileIfs($value);
        $value = $this->compileForeachs($value);
        $value = $this->compileFors($value);
        $value = $this->compileWhiles($value);
        // Then echos
        $value = $this->compileEchos($value);
        $value = $this->compileRawEchos($value);
        $value = $this->compileMethod($value);
        $value = $this->compileCsrf($value);

        return $value;
    }

    /**
     * Compile @if, @elseif, @else, @endif using balanced parentheses.
     *
     * Fixes the base class bug where greedy (.*) in the regex captures
     * too much when @if and {{ }} appear on the same line.
     *
     * @param string $value
     * @return string
     */
    protected function compileIfs(string $value): string
    {
        // Use PCRE recursive pattern (?1) to properly match balanced parentheses
        $value = preg_replace('/@if\s*(\((?:[^()]*|(?1))*\))/', '<?php if $1: ?>', $value);
        $value = preg_replace('/@elseif\s*(\((?:[^()]*|(?1))*\))/', '<?php elseif $1: ?>', $value);
        $value = preg_replace('/@else/', '<?php else: ?>', $value);
        $value = preg_replace('/@endif/', '<?php endif; ?>', $value);
        return $value;
    }
}
