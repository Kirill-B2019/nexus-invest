<?php

namespace App\Services\Indicators;

/**
 * Нормировка сырых метрик в шкалу 0–100 по опорным точкам (кусочно-линейная).
 */
class IndicatorNormalizer
{
    /**
     * Кусочно-линейная нормировка по трём опорным точкам (x → y).
     * Точки должны быть отсортированы по возрастанию x.
     *
     * @param  array<int, array{0: float, 1: float}>  $points
     */
    public static function piecewise(float $value, array $points): float
    {
        if ($points === []) {
            return 0.0;
        }

        usort($points, fn ($a, $b) => $a[0] <=> $b[0]);

        if ($value <= $points[0][0]) {
            return self::clamp($points[0][1]);
        }

        $last = $points[array_key_last($points)];
        if ($value >= $last[0]) {
            return self::clamp($last[1]);
        }

        for ($i = 0; $i < count($points) - 1; $i++) {
            [$x0, $y0] = $points[$i];
            [$x1, $y1] = $points[$i + 1];
            if ($value >= $x0 && $value <= $x1) {
                if (abs($x1 - $x0) < 1e-12) {
                    return self::clamp($y1);
                }
                $t = ($value - $x0) / ($x1 - $x0);

                return self::clamp($y0 + $t * ($y1 - $y0));
            }
        }

        return self::clamp($last[1]);
    }

    public static function placementGrowth(float $growth): float
    {
        // < -10% → 0; 0% → 50; > +20% → 100
        return self::piecewise($growth, [
            [-0.10, 0],
            [0.0, 50],
            [0.20, 100],
        ]);
    }

    public static function secondaryShare(float $share): float
    {
        // < 2% → 0; 3,6% → 40; > 10% → 100
        return self::piecewise($share, [
            [0.02, 0],
            [0.036, 40],
            [0.10, 100],
        ]);
    }

    public static function qualityShare(float $share): float
    {
        // < 20% → 0; 50% → 60; > 80% → 100
        return self::piecewise($share, [
            [0.20, 0],
            [0.50, 60],
            [0.80, 100],
        ]);
    }

    public static function userGrowth(float $growth): float
    {
        // < -15% → 0; 0% → 50; > +20% → 100
        return self::piecewise($growth, [
            [-0.15, 0],
            [0.0, 50],
            [0.20, 100],
        ]);
    }

    /**
     * Нормировка спреда: меньший спред = выше ликвидность.
     * > 5% → 0; 2% → 50; < 0.5% → 100
     */
    public static function spread(float $spreadPct): float
    {
        return self::piecewise($spreadPct, [
            [0.5, 100],
            [2.0, 50],
            [5.0, 0],
        ]);
    }

    /**
     * Нормировка времени выхода: быстрее = лучше.
     * > 30 дн → 0; 14 дн → 50; < 3 дн → 100
     */
    public static function timeToExit(int $days): float
    {
        return self::piecewise((float) $days, [
            [3, 100],
            [14, 50],
            [30, 0],
        ]);
    }

    public static function clamp(float $value, float $min = 0.0, float $max = 100.0): float
    {
        return max($min, min($max, round($value, 2)));
    }

    public static function safeRatio(?float $numerator, ?float $denominator): ?float
    {
        if ($numerator === null || $denominator === null || abs($denominator) < 1e-12) {
            return null;
        }

        return $numerator / $denominator;
    }

    public static function growthRate(?float $current, ?float $previous): ?float
    {
        if ($current === null || $previous === null || abs($previous) < 1e-12) {
            return null;
        }

        return ($current / $previous) - 1.0;
    }
}
