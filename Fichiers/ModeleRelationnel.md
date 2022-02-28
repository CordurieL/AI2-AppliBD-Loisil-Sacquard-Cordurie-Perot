# Tables en modele relationnel

character (<ins>id</ins>, name, real_name, last_name, alias, birthday, gender, deck, description, first_appeared_in_game_id, created_at, updated_at)

company (<ins>id</ins>, name, alias, abbreviation, deck, description, date_founded, location_address, location_city, location_country, location_state, phone, website, created_at, updated_at)

enemies (char1_id, char2_id)

friends (char1_id, char2_id)

game (<ins>id</ins>, name, alias, deck, description, expected_release_day, expected_release_month, expected_release_quarter, expected_release_year, original_release_date, created_at, updated_at)

game2character (game_id, character_id)

game2genre (game_id, genre_id)

game2platform (game_id, platform_id)

game2rating (game_id, rating_id)

game2theme (game_id, theme_id)

game_developers (game_id, comp_id)

game_publishers (game_id, comp_id)

game_rating (<ins>id</ins>, name, rating_board_id)

genre (<ins>id</ins>, name, deck, description)

platform (<ins>id</ins>, name, alias, abbreviation, deck, description, c_id, install_base, release_date, online_support, original_price, created_at, updated_at)

rating_board (<ins>id</ins>, name, deck, description)

similar_games (game1_id, game2_id)

theme (<ins>id</ins>, name)