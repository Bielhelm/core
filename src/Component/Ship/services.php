<?php

declare(strict_types=1);

namespace Stu\Component\Ship;

use Stu\Component\Ship\Storage\ShipStorageManager;
use Stu\Component\Ship\Storage\ShipStorageManagerInterface;
use Stu\Component\Ship\System\ShipSystemManager;
use Stu\Component\Ship\System\ShipSystemManagerInterface;
use Stu\Component\Ship\System\ShipSystemTypeEnum;
use Stu\Component\Ship\System\Type\CloakShipSystem;
use Stu\Component\Ship\System\Type\EnergyWeaponShipSystem;
use Stu\Component\Ship\System\Type\EpsShipSystem;
use Stu\Component\Ship\System\Type\ImpulseDriveShipSystem;
use Stu\Component\Ship\System\Type\LifeSupportShipSystem;
use Stu\Component\Ship\System\Type\LongRangeScannerShipSystem;
use Stu\Component\Ship\System\Type\NearFieldScannerShipSystem;
use Stu\Component\Ship\System\Type\ProjectileWeaponShipSystem;
use Stu\Component\Ship\System\Type\ShieldShipSystem;
use Stu\Component\Ship\System\Type\TachyonScannerShipSystem;
use Stu\Component\Ship\System\Type\TractorBeamShipSystem;
use Stu\Component\Ship\System\Type\WarpcoreShipSystem;
use Stu\Component\Ship\System\Type\WarpdriveShipSystem;
use Stu\Component\Ship\System\Type\ComputerShipSystem;
use Stu\Component\Ship\System\Type\TroopQuartersShipSystem;
use Stu\Component\Ship\System\Type\DeflectorShipSystem;
use Stu\Component\Ship\System\Type\SubspaceSensorShipSystem;
use function DI\autowire;
use function DI\create;

return [
    ShipStorageManagerInterface::class => autowire(ShipStorageManager::class),
    ShipSystemManagerInterface::class => create(ShipSystemManager::class)->constructor(
        [
            ShipSystemTypeEnum::SYSTEM_CLOAK => autowire(CloakShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_SHIELDS => autowire(ShieldShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_WARPDRIVE => autowire(WarpdriveShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_NBS => autowire(NearFieldScannerShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_PHASER => autowire(EnergyWeaponShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_LIFE_SUPPORT => autowire(LifeSupportShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_TACHYON_SCANNER => autowire(TachyonScannerShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_TORPEDO => autowire(ProjectileWeaponShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_LSS => autowire(LongRangeScannerShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_TRACTOR_BEAM => autowire(TractorBeamShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_WARPCORE => autowire(WarpcoreShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_EPS => autowire(EpsShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_IMPULSEDRIVE => autowire(ImpulseDriveShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_COMPUTER => autowire(ComputerShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_TROOP_QUARTERS => autowire(TroopQuartersShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_DEFLECTOR => autowire(DeflectorShipSystem::class),
            ShipSystemTypeEnum::SYSTEM_SUBSPACE_SCANNER => autowire(SubspaceSensorShipSystem::class)
        ]
    )
];
