package com.eventia.demo.services;

import java.util.List;

import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import com.eventia.demo.dto.ayuntamientos.AyuntamientoInsertDTO;
import com.eventia.demo.dto.ayuntamientos.AyuntamientoUpdateDTO;
import com.eventia.demo.entidades.Ayuntamiento;
import com.eventia.demo.entidades.Usuario;
import com.eventia.demo.repositories.AyuntamientoRepository;
import com.eventia.demo.repositories.UsuarioRepository;

@Service
public class AyuntamientoService {
	private final AyuntamientoRepository repository;
	private final UsuarioRepository usuarioRepo;

	public AyuntamientoService(AyuntamientoRepository repository, UsuarioRepository usuarioRepo) {
		this.repository = repository;
		this.usuarioRepo = usuarioRepo;
	}

	public List<Ayuntamiento> obtenerTodos() {
		return repository.findAll();
	}

	public Ayuntamiento obtenerPorId(int id) {
		return repository.findById(id).orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND));
	}

	public Ayuntamiento crear(AyuntamientoInsertDTO dto) {
		Usuario user = usuarioRepo.findById(dto.getIdUsuario())
				.orElseThrow(() -> new RuntimeException("Usuario no encontrado"));

		Ayuntamiento ayuntamiento = new Ayuntamiento();
		ayuntamiento.setUsuario(user);
		ayuntamiento.setNombreInstitucion(dto.getNombreInstitucion());
		ayuntamiento.setImagen(dto.getImagen());
		ayuntamiento.setComunidadAutonoma(dto.getComunidadAutonoma());
		ayuntamiento.setProvincia(dto.getProvincia());
		ayuntamiento.setLocalidad(dto.getLocalidad());
		ayuntamiento.setTelefono(dto.getTelefono());
		ayuntamiento.setEmailContacto(dto.getEmailContacto());
		ayuntamiento.setTipoEvento(dto.getTipoEvento() != null ? dto.getTipoEvento().name() : null);
		ayuntamiento.setFrecuencia(dto.getFrecuencia() != null ? dto.getFrecuencia().name() : null);
		ayuntamiento.setTipoEspacio(dto.getTipoEspacio() != null ? dto.getTipoEspacio().name() : null);
		ayuntamiento.setOpcionesAccesibilidad(dto.getOpcionesAccesibilidad());
		ayuntamiento.setTipoFacturacion(dto.getTipoFacturacion() != null ? dto.getTipoFacturacion().name() : null);
		ayuntamiento.setLogisticaPropia(dto.getLogisticaPropia());

		return repository.save(ayuntamiento);
	}

	public Ayuntamiento modificar(int id, AyuntamientoUpdateDTO dto) {
		Ayuntamiento ayuntamiento = obtenerPorId(dto.getId());

		ayuntamiento.setNombreInstitucion(dto.getNombreInstitucion());
		ayuntamiento.setImagen(dto.getImagen());
		ayuntamiento.setComunidadAutonoma(dto.getComunidadAutonoma());
		ayuntamiento.setProvincia(dto.getProvincia());
		ayuntamiento.setLocalidad(dto.getLocalidad());
		ayuntamiento.setTelefono(dto.getTelefono());
		ayuntamiento.setEmailContacto(dto.getEmailContacto());
		ayuntamiento.setTipoEvento(dto.getTipoEvento() != null ? dto.getTipoEvento().name() : null);
		ayuntamiento.setFrecuencia(dto.getFrecuencia() != null ? dto.getFrecuencia().name() : null);
		ayuntamiento.setTipoEspacio(dto.getTipoEspacio() != null ? dto.getTipoEspacio().name() : null);
		ayuntamiento.setOpcionesAccesibilidad(dto.getOpcionesAccesibilidad());
		ayuntamiento.setTipoFacturacion(dto.getTipoFacturacion() != null ? dto.getTipoFacturacion().name() : null);
		ayuntamiento.setLogisticaPropia(dto.getLogisticaPropia());

		return repository.save(ayuntamiento);
	}

	public void eliminar(int id) {
		if (!repository.existsById(id))
			throw new ResponseStatusException(HttpStatus.NOT_FOUND);
		repository.deleteById(id);
	}
}
