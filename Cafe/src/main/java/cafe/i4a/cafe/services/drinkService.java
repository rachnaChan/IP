package cafe.i4a.cafe.services;

import java.util.List;

import cafe.i4a.cafe.models.drink;

public interface drinkService {

    List<drink> getAllDrink();

    drink saveDrink(drink drink);

    drink getDrinkById(Long id);

    drink updateVieId(Long id, drink newDrink);

}