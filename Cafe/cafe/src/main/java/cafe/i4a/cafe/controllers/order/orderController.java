package cafe.i4a.cafe.controllers.order;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import cafe.i4a.cafe.models.orderDrink.orderedD;
import cafe.i4a.cafe.repositories.orderDrink.orderDRepository;
import cafe.i4a.cafe.services.orderDrink.orderDService;



@Controller
public class orderController {



    @Autowired
    private orderDRepository orderRepositories;

    @Autowired
    private orderDService orderServices;

    // @GetMapping("/orderHistory")
    // public String orderHistory(Model model) {
    //     model.addAttribute("ordered", orderRepositories.findAll());
    //     return "orderHistory";
    // }

    @RequestMapping(value= "/ordered", method= RequestMethod.GET)
    public String getOrderHistory(Model model){
        model.addAttribute("ordered", new orderedD());
        return "drink/drinkOrder";
    }

    @PostMapping("/ordered")
    public String addOrder(@ModelAttribute("ordered") orderedD orderedd) {
        orderServices.saveOrdered(orderedd);
        return "redirect:/drink/drinkOrder?success";
    }

    @GetMapping("/deleteOrdered/{id}")
    public String deleteOrdered(@PathVariable("id") Long id) {
        orderRepositories.deleteById(id);
        return "redirect:/drink/drinkOrder";

    }

    @GetMapping("/editOrdered/{id}")
    public String editOrdered(@PathVariable("id") Long id, @ModelAttribute("ordered") orderedD orderedd, Model model) {
        orderedD existOrdered = orderServices.getOrderedById(id);
        model.addAttribute("ordered", existOrdered);
        return "drink/drinkOrder";
    }

    @PostMapping("/editOrdered/{id}")
    public String updateOrdered(@PathVariable("id") Long id, @ModelAttribute("order") orderedD orderedd) {
        orderServices.saveOrdered(orderedd);
        return "redirect:/drink/drinkOrder";
    }





    
}
