<?php

declare(strict_types=1);

namespace Stu\Module\Ship\Action\DeactivateWarp;

use request;
use Stu\Component\Ship\System\ShipSystemTypeEnum;
use Stu\Module\Control\ActionControllerInterface;
use Stu\Module\Control\GameControllerInterface;
use Stu\Module\Ship\Action\Deactivate\AbstractSystemDeactivator;

final class DeactivateWarp extends AbstractSystemDeactivator implements ActionControllerInterface
{
    public const ACTION_IDENTIFIER = 'B_DEACTIVATE_WARP';

    public function handle(GameControllerInterface $game): void
    {
        $game->setView(ShowShip::VIEW_IDENTIFIER);

        $this->deactivate(request::indInt('id'), ShipSystemTypeEnum::SYSTEM_WARPDRIVE, _('Warpantrieb'), $game);
        
        // @TODO Alarm Rot
    }

    public function performSessionCheck(): bool
    {
        return true;
    }
}
