package cafe.i4a.cafe.controllers;

import java.util.Base64;

import org.springframework.beans.factory.annotation.Autowired;
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

import cafe.i4a.cafe.models.register;
import cafe.i4a.cafe.repositories.registerRepository;
import cafe.i4a.cafe.services.registerService;

@Controller
public class userRegisterController {

    @Autowired
    private registerService userService;

    @Autowired
    private registerRepository registerRepository;

    public userRegisterController(registerService userService) {
        super();
        this.userService = userService;
    }

    @RequestMapping(value = "/register", method = RequestMethod.GET)
    public String registers(Model model) {
        model.addAttribute("register", new register());
        return "register";
    }

    @GetMapping("/listCashier")
    public String showCashiers(Model model) {
        model.addAttribute("cashiers", userService.getAllCashiers());
        return "listCashier";
    }

    @PostMapping("/register")
    public String registerAccount(@ModelAttribute("cashier") register user, @RequestParam("file") MultipartFile file) {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            user.setImage(Base64.getEncoder().encodeToString(file.getBytes()));

        } catch (Exception e) {

        }
        userService.saveCashier(user);
        return "redirect:/register?success";
    }

    @GetMapping("/deleteCashier/{id}")
    public String deleteCashier(@PathVariable("id") Long id) {
        registerRepository.deleteById(id);
        return "redirect:/listCashier";

    }

    @GetMapping("/editCashier/{id}")
    public String editCashier(@PathVariable("id") Long id, @ModelAttribute("cashier") register cashier, Model model) {
        register existCashier = userService.getCashierById(id);
        model.addAttribute("cashier", existCashier);
        return "editCashiers";
    }

    @PostMapping("/editCashier/{id}")
    public String updateCashier(@PathVariable("id") Long id, @ModelAttribute("cashier") register cashier,
            @RequestParam("file") MultipartFile file) {
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());
        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            cashier.setImage(Base64.getEncoder().encodeToString(file.getBytes()));
            cashier.setId(id);

        } catch (Exception e) {

        }
        userService.saveCashier(cashier);
        return "redirect:/listCashier";
    }

}
