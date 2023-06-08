package cafe.i4a.cafe.controllers.cashier;

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

import cafe.i4a.cafe.models.cashier.register;
import cafe.i4a.cafe.repositories.cashier.registerRepository;
import cafe.i4a.cafe.services.cashier.registerService;
//import lombok.extern.slf4j.Slf4j;

@Controller
// @Slf4j
public class userRegisterController {

    @Autowired
    private registerService userService;

    @Autowired
    private registerRepository registerRepository;

    public userRegisterController(registerService userService) {
        super();
        this.userService = userService;
    }

    @RequestMapping(value = "/admin/register", method = RequestMethod.GET)
    public String registers(Model model) {
        model.addAttribute("register", new register());
        return "user/register";
    }

    @GetMapping("/admin/listCashier")
    public String showCashiers(Model model) {
        model.addAttribute("cashiers", userService.getAllCashiers());
        return "user/listCashier";
    }

    @PostMapping("/admin/register")
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
        return "redirect:/admin/register?success";
    }

    @GetMapping("/admin/deleteCashier/{id}")
    public String deleteCashier(@PathVariable("id") Long id) {
        registerRepository.deleteById(id);
        return "redirect:/admin/listCashier";

    }

    @GetMapping("/admin/editCashier/{id}")
    public String editCashier(@PathVariable("id") Long id, @ModelAttribute("cashier") register cashier, Model model) {
        register existCashier = userService.getCashierById(id);
        model.addAttribute("cashier", existCashier);
        return "user/editCashiers";
    }

    @PostMapping("/admin/editCashier/{id}")
    public String updateCashier(@PathVariable("id") Long id, @ModelAttribute("cashier") register cashier,
            @RequestParam("file") MultipartFile file) {

        // log.info("Cashierin controller {}",cashier);
        register existedUser = userService.getCashierById(cashier.getId());
        // log.info("{}",file.getOriginalFilename());
        String fileName = StringUtils.cleanPath(file.getOriginalFilename());

        if (fileName.contains("..")) {
            System.out.println("not valid");
        }

        try {
            cashier.setId(id);
            cashier.setRole(existedUser.getRole());
            cashier.setPassword(existedUser.getPassword());
            if (fileName == "") {
                cashier.setImage(existedUser.getImage());
            } else {
                cashier.setImage(Base64.getEncoder().encodeToString(file.getBytes()));

            }
        } catch (Exception e) {

        }
        userService.saveCashier(cashier);
        return "redirect:/admin/listCashier";
    }

}
