<?php

// Objets "mock" (=bidon) pour avoir des données en dev local
namespace Mini\Testing;


class FakeOdoo
{
    // Ici deux créneaux et juste leurs dates
    public function nextShifts()
    {
        return [
        // (object) permet de caster un array en objet et évite donc de passer par des classes
            0 => (object) [
                "me" => [
                    "struct" => [
                        "date_begin" => (object) [
                            "me" => [
                                "string" => '2016-10-30 12:30:00'
                            ]
                        ]
                    ]
                ]
            ],
            1 => (object) [
                "me" => [
                    "struct" => [
                        "date_begin" => (object) [
                            "me" => [
                                "string" => '2016-11-27 19:30:00'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    // Les infos de Zied, parce qu'on l'aime bien
    // TODO_LATER: pouvoir changer ces valeurs pour faire des tests différents en local
    public function userInfo()
    {
        return [
            0 => (object) [
                "me" => [
                    "struct" => [
                        "street" => (object) [
                            "me" => [
                                "string" => 'Quelque part dans Paris 750xx'
                            ]
                        ],
                        "mobile" => (object) [
                            "me" => [
                                "string" => '06 00 00 00 00'
                            ]
                        ],
                        "shift_type" => (object) [
                            "me" => [
                                "string" => 'shift type' // /!\ valeur au hasard, existe pas forcément
                            ]
                        ],
                        "cooperative_state" => (object) [
                            "me" => [
                                "string" => 'coop state' // /!\ valeur au hasard, existe pas forcément
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }
}
