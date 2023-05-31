package cafe.i4a.cafe.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import cafe.i4a.cafe.models.ordered;
import cafe.i4a.cafe.repositories.orderRepository;
import cafe.i4a.cafe.services.orderService;

@Controller
public class orderController {

    @Autowired
    private orderRepository orderRepositories;

    @Autowired
    private orderService orderServices;

    // @GetMapping("/orderHistory")
    // public String orderHistory(Model model) {
    //     model.addAttribute("ordered", orderRepositories.findAll());
    //     return "orderHistory";
    // }

    @RequestMapping(value= "/ordered", method= RequestMethod.GET)
    public String getOrderHistory(Model model){
        model.addAttribute("ordered", new ordered());
        return "drinkOrder";
    }

    @PostMapping("/ordered")
    public String addOrder(@ModelAttribute("ordered") ordered orderedd) {
        orderServices.saveOrdered(orderedd);
        return "redirect:/drinkOrder?success";
    }

    @GetMapping("/deleteOrdered/{id}")
    public String deleteOrdered(@PathVariable("id") Long id) {
        orderRepositories.deleteById(id);
        return "redirect:/drinkOrder";

    }

    @GetMapping("/editOrdered/{id}")
    public String editOrdered(@PathVariable("id") Long id, @ModelAttribute("ordered") ordered orderedd, Model model) {
        ordered existOrdered = orderServices.getOrderedById(id);
        model.addAttribute("ordered", existOrdered);
        return "drinkOrder";
    }

    @PostMapping("/editOrdered/{id}")
    public String updateOrdered(@PathVariable("id") Long id, @ModelAttribute("order") ordered orderedd) {
        orderServices.saveOrdered(orderedd);
        return "redirect:/drinkOrder";
    }





    
}
