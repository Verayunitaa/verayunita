// OrderFormController.java (Spring Boot Controller)

package com.example.orderform;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

@Controller
public class OrderFormController {
    @GetMapping("/")
    public String showForm() {
        return "orderForm";
    }

    @PostMapping("/calculate")
    public String calculateTotal(@RequestParam int nasiGoreng, @RequestParam int ayamGoreng,
                                 @RequestParam int esTeh, @RequestParam int kopi, Model model) {
        int total = (nasiGoreng * 10000) + (ayamGoreng * 12000) + (esTeh * 2000) + (kopi * 3000);
        model.addAttribute("total", total);
        return "orderForm";
    }
}
