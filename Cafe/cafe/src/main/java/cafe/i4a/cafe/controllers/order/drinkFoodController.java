package cafe.i4a.cafe.controllers.order;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;

import cafe.i4a.cafe.drinkFoodOrder.drinkFoodOrder;

import cafe.i4a.cafe.services.drink.drinkService;
import cafe.i4a.cafe.services.food.foodService;
import cafe.i4a.cafe.services.ordered.orderedService;
import cafe.i4a.cafe.services.implementations.drink.drinkImplementation;
import cafe.i4a.cafe.services.implementations.food.foodImplementation;
import jakarta.servlet.http.HttpSession;

@Controller
public class drinkFoodController {
    @Autowired
    private drinkService drinkServices;

    @Autowired
    private foodService foodServices;

    @Autowired
    private foodImplementation foodImplementations;

    @Autowired
    private drinkImplementation drinkImplementations;

    @Autowired
    private orderedService orderedServices;

    @GetMapping("/admin/orderHistory")
    public String orderhistory(Model model) {
        model.addAttribute("orderedd", orderedServices.getAllOrdered());
        return "order/orderHistories";
    }

    @GetMapping(path = "/cashier/drinkFoodOrder")
    public String drinkOrder(Model model, HttpSession session) {
        model.addAttribute("drinks", drinkServices.getAllDrink());
        model.addAttribute("foods", foodServices.getAllFood());
        // model.addAttribute("invoice", )
        // String tableSelected = (String) session.getAttribute("tableSelected");
        // model.addAttribute("tableSelected", tableSelected);
        return "drink/drinkFoodOrder";
    }

    @PostMapping(path = "/cashier/drinkFoodOrder/confirm/{id}")
    public String addToCart(@PathVariable("id") Long id, @ModelAttribute ("dfordered") drinkFoodOrder drinkFoodOrders, Model model) {

        model.addAttribute("dfordered", drinkFoodOrder.cartDrinks.add(drinkImplementations.getDrinkById(id)));

        model.addAttribute("dfordered", drinkFoodOrder.cartFoods.add(foodImplementations.getFoodById(id)));

        // drinkFoodOrder.cartDrinks.add(drinkServices.getDrinkById(id).get());
        // drinkFoodOrder.cartFoods.add(foodServices.getFoodById(id).get());
        return "redirect:/cashier/drinkFoodOrder";

    }

    @GetMapping("/cashier/showOrderDrink")
    public String showCart(Model model) {
        model.addAttribute("cartAmount", drinkFoodOrder.cartDrinks.size());
        model.addAttribute("cartAmount", drinkFoodOrder.cartFoods.size());
        model.addAttribute("cart", drinkFoodOrder.cartDrinks);
        model.addAttribute("cart", drinkFoodOrder.cartFoods);
        return "order/drinkFoodOrder";
    }

}