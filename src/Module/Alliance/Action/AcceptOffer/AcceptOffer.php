<?php

declare(strict_types=1);

namespace Stu\Module\Alliance\Action\AcceptOffer;

use AllianceRelation;
use HistoryEntry;
use Stu\Control\ActionControllerInterface;
use Stu\Control\GameControllerInterface;

final class AcceptOffer implements ActionControllerInterface
{
    public const ACTION_IDENTIFIER = 'B_ACCEPT_OFFER';

    private $acceptOfferRequest;

    public function __construct(
        AcceptOfferRequestInterface $acceptOfferRequest
    ) {
        $this->acceptOfferRequest = $acceptOfferRequest;
    }

    public function handle(GameControllerInterface $game): void
    {
        $user = $game->getUser();
        $alliance = $user->getAlliance();
        $userId = $user->getId();
        $allianceId = $alliance->getId();

        $relation = AllianceRelation::getById($this->acceptOfferRequest->getRelationId());

        if (!$relation || $relation->getRecipientId() != $allianceId) {
            return;
        }
        if (!$relation->isPending()) {
            return;
        }
        $rel = AllianceRelation::getBy(
            sprintf(
                'date > 0 AND ((alliance_id = %d AND recipient = %d) OR (alliance_id = %d AND recipient = %d))',
                $relation->getAllianceId(),
                $relation->getRecipientId(),
                $relation->getRecipientId(),
                $relation->getAllianceId()
            )
        );
        if ($rel) {
            $rel->deleteFromDatabase();
        }
        $relation->setDate(time());
        $relation->save();

        $text = sprintf(
            _("%s abgeschlossen!\nDie Allianz %s hat hat das Angebot angenommen"),
            $relation->getTypeDescription(),
            $alliance->getNameWithoutMarkup()
        );

        HistoryEntry::addAllianceEntry(
            sprintf(
                _('Die Allianzen %s und %s sind ein %s eingegangen'),
                $relation->getAlliance()->getName(),
                $relation->getOpponent()->getName(),
                $relation->getTypeDescription()
            ),
            $userId
        );

        if ($relation->getAllianceId() == $allianceId) {
            $relation->getOpponent()->sendMessage($text);
        } else {
            $relation->getAlliance()->sendMessage($text);
        }

        $game->addInformation(_('Das Angebot wurden angemommen'));
    }

    public function performSessionCheck(): bool
    {
        return true;
    }
}
