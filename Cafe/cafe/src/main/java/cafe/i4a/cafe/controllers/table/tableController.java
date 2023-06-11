package cafe.i4a.cafe.controllers.table;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;

import cafe.i4a.cafe.models.table.table;
import cafe.i4a.cafe.repositories.table.tableRepository;
import cafe.i4a.cafe.services.table.tableService;
import jakarta.servlet.http.HttpSession;

@Controller
public class tableController {

    @Autowired
    private tableService tableService;

    @Autowired
    private tableRepository tableRepositories;

    @GetMapping("/cashier/tableSelection")
    public String tableSelection(Model model, HttpSession session) {
        model.addAttribute("tables", tableService.getAllTables());
        table Table = new table();
        session.setAttribute("tableSelected", Table);
        return "table/tableSelection";
    }

    @RequestMapping(value = "/admin/addTable", method = RequestMethod.GET)
    public String tables(Model model) {
        model.addAttribute("tables", new table());
        return "table/addTable";
    }

    @GetMapping("/admin/listTable")
    public String showTables(Model model) {
        model.addAttribute("tables", tableService.getAllTables());
        return "table/listTable";
    }

    @PostMapping("/admin/addTable")
    public String addTables(@ModelAttribute("tables") table tables) {

        tableService.saveTables(tables);
        return "redirect:/admin/addTable?success";
    }

    @GetMapping("/cashier/editTable/{id}")
    public String editTables(@PathVariable("id") Long id, @ModelAttribute("tables") table tables, Model model) {
        table existTable = tableService.getTableById(id);
        model.addAttribute("tables", existTable);
        return "table/editTables";
    }

    @PostMapping("/cashier/editTable/{id}")
    public String updateTables(@PathVariable("id") Long id, @ModelAttribute("tables") table tables) {

        tableService.saveTables(tables);
        return "table/editTables";
    }

    @PostMapping("/cashier/order/table/{id}")
    public String selectedTable(@PathVariable("id") Long id, Model model, HttpSession session) {
        String tableId = (String) session.getAttribute("tableSelected");
        tableId = id.toString();
        session.setAttribute("tableSelected", tableId);
        return "redirect:/drinkFoodOrder";
    }

    @GetMapping("/admin/deleteTable/{id}")
    public String deleteFoodk(@PathVariable("id") Long id) {
        tableRepositories.deleteById(id);
        return "redirect:/admin/listTable";

    }
}
