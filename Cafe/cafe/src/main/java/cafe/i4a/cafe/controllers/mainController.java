package cafe.i4a.cafe.controllers;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.servlet.ModelAndView;
import org.springframework.web.bind.annotation.RestController;

@RestController

public class mainController {

    @GetMapping(path = "/logout")
    public Object loginAC() {
        return new ModelAndView("login");
    }

    // @GetMapping(path = "/admin")
    // public Object admins() {
    // return new ModelAndView("menu/admin");
    // }

    @GetMapping(path = "/cashier/calculator")
    public Object calculators() {
        return new ModelAndView("calculator");
    }

    @GetMapping(path = "/cashier/receipt")
    public Object receipts() {
        return new ModelAndView("receipt");
    }

    @GetMapping(path = "/cashier/test")
    public Object editDrinkssss() {
        return new ModelAndView("add-edit");
    }

    @GetMapping(path = "/login")
    public Object LoginAcc() {
        return new ModelAndView("login");
    }

}
