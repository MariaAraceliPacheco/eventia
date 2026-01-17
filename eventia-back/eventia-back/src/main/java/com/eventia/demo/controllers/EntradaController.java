package com.eventia.demo.controllers;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.eventia.demo.dto.artistas.EntradaInsertDTO;
import com.eventia.demo.entidades.Entrada;
import com.eventia.demo.entidades.Evento;
import com.eventia.demo.entidades.Publico;
import com.eventia.demo.repositories.EntradaRepository;
import com.eventia.demo.repositories.EventoRepository;
import com.eventia.demo.repositories.PublicoRepository;


/*
 * ELIMINAR ESTE CONTROLADOR O CAMBIAR SU LOGICA A UN SERVICIO
 * */
@RestController
@RequestMapping("/entradas")
public class EntradaController {

	private final EntradaRepository entradaRepo;
	private final EventoRepository eventoRepo;
	private final PublicoRepository publicoRepo;

	public EntradaController(EntradaRepository e, EventoRepository ev, PublicoRepository p) {
		this.entradaRepo = e;
		this.eventoRepo = ev;
		this.publicoRepo = p;
	}

	@PostMapping
	public Entrada comprar(@RequestBody EntradaInsertDTO dto) {
		Evento ev = eventoRepo.findById(dto.getId_evento()).orElseThrow();
		Publico pub = publicoRepo.findById(dto.getId_publico()).orElseThrow();

		Entrada ent = new Entrada();
		ent.setEvento(ev);
		ent.setPublico(pub);
		ent.setPrecio(dto.getPrecio());
		ent.setTipoEntrada(dto.getTipo_entrada());
		ent.setEstado("pagado");

		return entradaRepo.save(ent);
	}

}
