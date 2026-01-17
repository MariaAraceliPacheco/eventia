package com.eventia.demo.controllers;

import java.util.List;

import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import com.eventia.demo.dto.artistas.ArtistaInsertDTO;
import com.eventia.demo.dto.artistas.ArtistaUpdateDTO;
import com.eventia.demo.entidades.Artista;
import com.eventia.demo.services.ArtistaService;

@RestController
@RequestMapping("/artistas")
public class ArtistaController {
	private final ArtistaService service;

	public ArtistaController(ArtistaService service) {
		this.service = service;
	}

	@GetMapping
	public List<Artista> listar() {
		return service.obtenerTodos();
	}

	@GetMapping("/{id}")
	public Artista buscar(@PathVariable int id) {
		return service.obtenerPorId(id);
	}

	@PostMapping(consumes = MediaType.APPLICATION_JSON_VALUE)
	public Artista crear(@RequestBody ArtistaInsertDTO dto) {
		return service.crear(dto);
	}

	@PutMapping("/{id}")
	public Artista actualizar(@PathVariable int id, @RequestBody ArtistaUpdateDTO dto) {
		return service.modificar(id, dto);
	}

	@DeleteMapping("/{id}")
	public ResponseEntity<Void> eliminar(@PathVariable int id) {
		service.eliminar(id);
		return ResponseEntity.noContent().build();
	}
}
