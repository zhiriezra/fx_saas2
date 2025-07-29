<x-filament-panels::page>
    <div class="w-full h-screen">
        @if(auth()->user()->teams->first()->name == 'Golden Fertiliser')
        <iframe
            title="FMAN Report"
            class="w-full h-full border-none"
            src="https://app.powerbi.com/view?r=eyJrIjoiMDE3ZGRmZDctZTJmMS00MTNiLThkMjgtMDc1MTY2NDk1YzZmIiwidCI6IjY0ODMzYzU4LWFjYzQtNDFlMy1iZDk2LWYxZWUxOWE3NzZmMSJ9&pageName=c86f1232309db1bbce9d" frameborder="0"
            allowFullScreen="true">
        </iframe>
        @elseif(auth()->user()->teams->first()->name == 'Mafa')
        <iframe 
            title="Mafa Analysis Report" 
            class="w-full h-full border-none"
            src="https://app.powerbi.com/view?r=eyJrIjoiMzYzNGZlMDQtZWU0Ni00OTU4LTkyNTItODhkNTZkMDlmYTM1IiwidCI6IjU4ODBmZDMzLTYyZmEtNGM0Ny1iYTFmLWJhMWE1ODM5Mjc2NyJ9" 
            frameborder="0" 
            allowFullScreen="true">
        </iframe>
        @else
            <p>No report available</p>
        @endif
    </div>
</x-filament-panels::page>
