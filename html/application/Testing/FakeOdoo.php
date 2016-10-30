<?php

// Objets "mock" (=bidon) pour avoir des données en dev local
// Ici deux créneaux et juste leurs dates
namespace Mini\Testing;

class FakeOdoo
{
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

    public function userInfo()
    {
        return [
            0 => (object) [
                "me" => [
                    "struct" => [
                        "name" => (object) [
                            "me" => [
                                "string" => 'Zied'
                            ]
                        ],
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
                        "final_standard_point" => (object) [
                            "me" => [
                                "string" => 'final standard point' // /!\ valeur au hasard, existe pas forcément
                            ]
                        ],
                        "final_ftop_point" => (object) [
                            "me" => [
                                "string" => 'final ftop point' // /!\ valeur au hasard, existe pas forcément
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }
}
