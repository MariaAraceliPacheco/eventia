package com.eventia.demo.services;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import com.eventia.demo.entidades.Ayuntamiento;
import com.eventia.demo.entidades.Evento;
import com.eventia.demo.repositories.AyuntamientoRepository;
import com.eventia.demo.repositories.EventoRepository;
import com.eventia.demo.dto.eventos.EventoInsertDTO;
import com.eventia.demo.dto.eventos.EventoUpdateDTO;

@Service
public class EventoService {
	private final EventoRepository eventoRepo;
	private final AyuntamientoRepository ayuntamientoRepo;

	public EventoService(EventoRepository eventoRepo, AyuntamientoRepository ayuntamientoRepo) {
		this.eventoRepo = eventoRepo;
		this.ayuntamientoRepo = ayuntamientoRepo;
	}

	public Evento crear(EventoInsertDTO dto) {
		Ayuntamiento ayunto = ayuntamientoRepo.findById(dto.getId_ayuntamiento())
				.orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Ayuntamiento no encontrado"));

		Evento evento = new Evento();
		evento.setAyuntamiento(ayunto);
		evento.setNombreEvento(dto.getNombre_evento());
		evento.setDescripcion(dto.getDescripcion());
		evento.setPrecio(dto.getPrecio());
		evento.setFechaInicio(dto.getFecha_inicio());

		return eventoRepo.save(evento);
	}

	public List<Evento> obtenerTodos() {
		return eventoRepo.findAll();
	}

	public Evento obtenerPorId(int id) {
		return eventoRepo.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
	}

	public Evento modificar(int id, EventoUpdateDTO dto) {
		Evento e = obtenerPorId(id);
		e.setNombreEvento(dto.getNombre_evento());
		e.setDescripcion(dto.getDescripcion());
		e.setCategoria(dto.getCategoria());
		e.setPrecio(dto.getPrecio());
		e.setFechaInicio(dto.getFecha_inicio());
		e.setProvincia(dto.getProvincia());
		e.setLocalidad(dto.getLocalidad());
		return eventoRepo.save(e);
	}

	public void eliminar(int id) {
		if (!eventoRepo.existsById(id))
			throw new ResponseStatusException(HttpStatus.NOT_FOUND);
		eventoRepo.deleteById(id);
	}
}
