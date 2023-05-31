package cafe.i4a.cafe.controllers.drink;

import java.util.Base64;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;

import cafe.i4a.cafe.models.drink.drink;
import cafe.i4a.cafe.repositories.drink.drinkRepository;
import cafe.i4a.cafe.services.cashier.registerService;
import cafe.i4a.cafe.services.drink.drinkService;
import cafe.i4a.cafe.services.food.foodService;
//import lombok.extern.slf4j.Slf4j;

@Controller
// @Slf4j
public class drinkController {

    @Autowired
    private drinkService drinkServices;

    @Autowired
    private foodService foodServices;

    @Autowired
    private registerService userService;

    @Autowired
    private drinkRepository drinkRepository;

    public drinkController(drinkService drinkServices) {
        super();
        this.drinkServices = drinkServices;
    }

    @GetMapping("/admin")
    public String Admins(Model model) {
        model.addAttribute("drinks", userService.getAllCashiers());
        return "menu/admin";
    }

    @GetMapping("/orderHistory")
    public String orderhistory(Model model) {
        model.addAttribute("drinks", drinkServices.getAllDrink());
        return "order/orderHistories";
    }

    @RequestMapping(value = "/addDrink", method = RequestMethod.GET)
    public String drinks(Model model) {
        model.addAttribute("drink", new drink());
        return "drink/addDrink";
    }

    @GetMapping("/listDrink")
    public String showDrinks(Model model) {
        model.addAttribute("drinks", drinkServices.getAllDrink());
        return "drink/listDrink";
    }

    @GetMapping(path = "/drinkOrder")
    public String drinkOrder(Model model) {
        model.addAttribute("drinks", drinkServices.getAllDrink());
        model.addAttribute("foods", foodServices.getAllFood());
        return "drink/drinkOrder";
    }

    @GetMapping(path = "/listDrinkAdmin")

    public String drinkHome(Model model) {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String usernameLoggend = ((UserDetails) principal).getUsername();
        model.addAttribute("drinks", drinkServices.getAllDrink());
        model.addAttribute("foods", foodServices.getAllFood());
        // log.info("Object is {}",userService.getByUsername(usernameLoggend));
        model.addAttribute("userlogged", userService.getByUsername(usernameLoggend));
        return "menu/listDrinkAdmin";
    }

    @GetMapping(path = "/homepageCashier")
    public String homepagecashier(Model model) {
        Object principal = SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        String usernameLoggend = ((UserDetails) principal).getUsername();

        model.addAttribute("drinks", drinkServices.getAllDrink());
        model.addAttribute("foods", foodServices.getAllFood());
        model.addAttribute("userlogged", userService.getByUsername(usernameLoggend));
        return "menu/homepageCashier";
    }

    @PostMapping("/addDrink")
    public String addDrinks(@ModelAttribute("drink") drink drinks, @RequestParam("file") MultipartFile file) {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            drinks.setImage(Base64.getEncoder().encodeToString(file.getBytes()));

        } catch (Exception e) {

        }
        drinkServices.saveDrink(drinks);
        return "redirect:/addDrink?success";
    }

    @GetMapping("/deleteDrink/{id}")
    public String deleteDrink(@PathVariable("id") Long id) {
        drinkRepository.deleteById(id);
        return "redirect:/listDrink";

    }

    @GetMapping("/editDrink/{id}")
    public String editDrinks(@PathVariable("id") Long id, @ModelAttribute("drink") drink drinks, Model model) {
        drink existDrink = drinkServices.getDrinkById(id);
        model.addAttribute("drink", existDrink);
        return "drink/editDrinks";
    }

    @PostMapping("/editDrink/{id}")
    public String updateDrinks(@PathVariable("id") Long id, @ModelAttribute("drink") drink drinks,
            @RequestParam("file") MultipartFile file) {

        drink existedDrink = drinkServices.getDrinkById(id);

        String fileName = StringUtils.cleanPath(file.getOriginalFilename());

        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            drinks.setDcode(existedDrink.getDcode());
            drinks.setId(id);
            if (fileName == "") {
                drinks.setImage(existedDrink.getImage());
            } else {
                drinks.setImage(Base64.getEncoder().encodeToString(file.getBytes()));
            }

        } catch (Exception e) {

        }
        drinkServices.saveDrink(drinks);
        return "redirect:/listDrink";
    }

}
